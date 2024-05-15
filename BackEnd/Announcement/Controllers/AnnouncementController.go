package controllers

import (
	database "Announcement/Database"
	"Announcement/Models/entity"
	"Announcement/Models/response"
	utils "Announcement/Utils"
	"encoding/json"
	"fmt"
	"net/http"
	"os"
	"path/filepath"
	"strconv"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

var PathAnnouncementImage = "./Public"

func init() {
	if _, err := os.Stat(PathAnnouncementImage); os.IsNotExist(err) {
		os.Mkdir(PathAnnouncementImage, os.ModePerm)
	}
}

func getAnnouncementCategoryByID(categoryID int) (*entity.AnnouncementCategory, error) {
	resp, err := http.Get(fmt.Sprintf("http://127.0.0.1:8001/announcementCategory/%d", categoryID))
	if err != nil {
		return nil, fmt.Errorf("failed to make HTTP request: %v", err)
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		return nil, fmt.Errorf("HTTP request failed with status code: %d", resp.StatusCode)
	}

	var AnnouncementCategory entity.AnnouncementCategory
	if err := json.NewDecoder(resp.Body).Decode(&AnnouncementCategory); err != nil {
		return nil, fmt.Errorf("failed to decode JSON response: %v", err)
	}

	return &AnnouncementCategory, nil
}

func Announcement(a *fiber.Ctx) error {
	var Announcement []entity.Announcement

	result := database.DB.Debug().Find(&Announcement)

	if len(Announcement) == 0 {
		return a.Status(404).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Not Found",
		})
	}

	if result.Error != nil {
		return a.Status(500).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Couldn't find data",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": Announcement,
	})
}

func GetAnnouncementByID(a *fiber.Ctx) error {
	id := a.Params("id")

	var announcement entity.Announcement

	err := database.DB.First(&announcement, "id = ?", id).Error

	if err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Announcement Not Found",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": announcement,
	})
}

func CreateAnnouncement(a *fiber.Ctx) error {
	input := new(response.RequestCreateAnnouncement)

	if err := a.BodyParser(input); err != nil {
		return err
	}

	validation := validator.New()
	if err := validation.Struct(input); err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status":  "Failed",
			"message": err.Error(),
		})
	}

	image, err := a.FormFile("image")
	if err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Image is required",
		})
	}

	CatId, err := strconv.Atoi(a.FormValue("category_id"))
	if err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "CatId is required",
		})
	}

	filename := utils.GenerateImageFile(input.Title, image.Filename)

	if err := a.SaveFile(image, filepath.Join(PathAnnouncementImage, filename)); err != nil {
		return a.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't save file image",
		})
	}

	category, err := getAnnouncementCategoryByID(CatId)
	if err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	category.Id = uint(CatId)

	Announcement := entity.Announcement{
		Title:      input.Title,
		Content:    input.Content,
		Image:      filename,
		CategoryID: uint(CatId),
	}

	result := database.DB.Create(&Announcement)
	if result.Error != nil {
		return a.Status(500).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Couldn't create data",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": "Announcement created successfully",
		"data":    Announcement,
	})
}

func UpdateAnnouncement(c *fiber.Ctx) error {
	id := c.Params("id")
	input := new(response.RequestUpdateAnnouncement)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	var announcement entity.Announcement

	err := database.DB.First(&announcement, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}

	if input.Title != "" {
		announcement.Title = input.Title
	}
	if input.Content != "" {
		announcement.Content = input.Content
	}

	categoryId, err := strconv.Atoi(c.FormValue("category_id"))
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	if categoryId != 0 {
		category, err := getAnnouncementCategoryByID(categoryId)
		if err != nil {
			return c.Status(400).JSON(fiber.Map{
				"status":  "failed",
				"message": err.Error(),
			})
		}
		category.Id = uint(categoryId)
		announcement.CategoryID = uint(categoryId)
	}

	newImage, err := c.FormFile("image")
	if err == nil {
		if announcement.Image != "" {
			oldPath := filepath.Join(PathAnnouncementImage, announcement.Image)
			os.Remove(oldPath)
		}

		newFileName := utils.GenerateImageFile(announcement.Title, newImage.Filename)
		if err := c.SaveFile(newImage, filepath.Join(PathAnnouncementImage, newFileName)); err != nil {
			return err
		}

		announcement.Image = newFileName
	}
	result := database.DB.Save(&announcement)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't update product",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": announcement,
	})
}

func DeleteAnnouncement(c *fiber.Ctx) error {
	id := c.Params("id")

	var announcement entity.Announcement

	err := database.DB.Debug().First(&announcement, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Announcement Not Found",
		})
	}

	if err := database.DB.Debug().Delete(&announcement).Error; err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't Delete Announcement",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": "Announcement deleted successfully!",
	})
}
