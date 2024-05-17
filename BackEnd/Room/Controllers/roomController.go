package controllers

import (
	"encoding/json"
	"fmt"
	"net/http"
	"os"
	"path/filepath"
	database "room/Database"
	entity "room/Models/Entity"
	request "room/Models/Request"
	utils "room/Utils"
	"strconv"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

var PathRoomImage = "./Public"

func init() {
	if _, err := os.Stat(PathRoomImage); os.IsNotExist(err) {
		os.Mkdir(PathRoomImage, os.ModePerm)
	}
}

func getRoomCategoryByID(categoryID int) (*entity.RoomCategory, error) {
	resp, err := http.Get(fmt.Sprintf("http://127.0.0.1:8081/roomCategory/%d", categoryID)) // Perbaikan: Menggunakan %d untuk format integer
	if err != nil {
		return nil, fmt.Errorf("failed to make HTTP request: %v", err)
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		return nil, fmt.Errorf("HTTP request failed with status code: %d", resp.StatusCode)
	}

	var categoryKamar entity.RoomCategory
	if err := json.NewDecoder(resp.Body).Decode(&categoryKamar); err != nil {
		return nil, fmt.Errorf("failed to decode JSON response: %v", err)
	}

	return &categoryKamar, nil
}

func GetAllRoom(c *fiber.Ctx) error {
	var rooms []entity.Room

	result := database.DB.Find(&rooms)

	if len(rooms) == 0 {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}

	if result.Error != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": rooms,
	})
}

func GetRoomByID(c *fiber.Ctx) error {
	id := c.Params("id")

	var rooms entity.Room

	err := database.DB.First(&rooms, "id = ?", id).Error

	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Room Not Found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": rooms,
	})
}

func CreateRoom(c *fiber.Ctx) error {
	input := new(request.RequestRoomCreate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	validation := validator.New()
	if err := validation.Struct(input); err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "Failed",
			"message": err.Error(),
		})
	}

	image, err := c.FormFile("image")
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Image is required",
		})
	}

	CatId, err := strconv.Atoi(c.FormValue("category_id"))
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "CatId is required",
		})
	}

	filename := utils.GenerateImageFile(input.Name, image.Filename)

	if err := c.SaveFile(image, filepath.Join(PathRoomImage, filename)); err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't save file image",
		})
	}

	category, err := getRoomCategoryByID(CatId)
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	category.Id = uint(CatId)

	rooms := entity.Room{
		Name:       input.Name,
		Facility:   input.Facility,
		Capacity:   input.Capacity,
		Price:      input.Price,
		Image:      filename,
		CategoryID: uint(CatId),
	}

	result := database.DB.Create(&rooms)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't create room",
		})
	}
	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": rooms,
	})
}

func UpdateRoom(c *fiber.Ctx) error {
	id := c.Params("id")
	input := new(request.RequestRoomUpdate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	var rooms entity.Room

	err := database.DB.First(&rooms, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}

	if input.Name != "" {
		rooms.Name = input.Name
	}
	if input.Facility != "" {
		rooms.Facility = input.Facility
	}
	if input.Capacity != 0 {
		rooms.Capacity = input.Capacity
	}
	if input.Price != 0 {
		rooms.Price = input.Price
	}

	categoryId, err := strconv.Atoi(c.FormValue("category_id"))
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	if categoryId != 0 {
		category, err := getRoomCategoryByID(categoryId)
		if err != nil {
			return c.Status(400).JSON(fiber.Map{
				"status":  "failed",
				"message": err.Error(),
			})
		}
		category.Id = uint(categoryId)
		rooms.CategoryID = uint(categoryId)
	}

	newImage, err := c.FormFile("image")
	if err == nil {
		if rooms.Image != "" {
			oldPath := filepath.Join(PathRoomImage, rooms.Image)
			os.Remove(oldPath)
		}

		newFileName := utils.GenerateImageFile(rooms.Name, newImage.Filename)
		if err := c.SaveFile(newImage, filepath.Join(PathRoomImage, newFileName)); err != nil {
			return err
		}

		rooms.Image = newFileName
	}
	result := database.DB.Save(&rooms)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't update product",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": rooms,
	})
}

func DeleteRoom(c *fiber.Ctx) error {
	id := c.Params("id")

	var rooms entity.Room

	err := database.DB.Debug().First(&rooms, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Room Not Found",
		})
	}

	if err := database.DB.Debug().Delete(&rooms).Error; err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't Delete Room",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": "Room deleted successfully!",
	})
}
