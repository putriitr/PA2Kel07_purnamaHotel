package controllers

import (
	database "facility/Database"
	entity "facility/Models/Entity"
	request "facility/Models/Request"
	utils "facility/Utils"
	"os"
	"path/filepath"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

var PathImageFacility = "./Public"

func init() {
	if _, err := os.Stat(PathImageFacility); os.IsNotExist(err) {
		os.Mkdir(PathImageFacility, os.ModePerm)
	}
}

func GetAllFacility(c *fiber.Ctx) error {
	var facility []entity.Facility

	result := database.DB.Find(&facility)

	if len(facility) == 0 {
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
		"message": facility,
	})
}

func GetFacilityByID(c *fiber.Ctx) error {
	id := c.Params("id")

	var facility entity.Facility

	err := database.DB.First(&facility, "id = ?", id).Error

	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Facility Not Found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": facility,
	})
}

func CreateFacility(c *fiber.Ctx) error {
	input := new(request.RequestFacilityCreate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	// Validate input struct
	validation := validator.New()
	if err := validation.Struct(input); err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	// Get image file from form
	image, err := c.FormFile("image")
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Image is required",
		})
	}

	// Generate image filename
	filename := utils.GenerateImageFile(input.Name, image.Filename)

	// Save image file
	if err := c.SaveFile(image, filepath.Join(PathImageFacility, filename)); err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't save file image",
		})
	}

	// Create Galery entity
	facility := entity.Facility{
		Name:      input.Name,
		Description: input.Description,
		Image:    filename, // Save filename instead of input.Gambar
	}

	// Save Galery to database
	result := database.DB.Create(&facility)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't create Facility",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": facility,
	})
}

func UpdateFacility(c *fiber.Ctx) error {
	id := c.Params("id")
	input := new(request.RequestFacilityUpdate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	var facility entity.Facility

	err := database.DB.First(&facility, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}
	if input.Name != "" {
		facility.Name = input.Name
	}
	if input.Description != "" {
		facility.Description = input.Description
	}

	newImage, err := c.FormFile("image")
	if err == nil {
		if facility.Image != "" {
			oldPath := filepath.Join(PathImageFacility, facility.Image)
			os.Remove(oldPath)
		}

		newFileName := utils.GenerateImageFile(facility.Name, newImage.Filename)
		if err := c.SaveFile(newImage, filepath.Join(PathImageFacility, newFileName)); err != nil {
			return err
		}

		facility.Image = newFileName
	}

	result := database.DB.Save(&facility)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't update Facility",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": facility,
	})
}

func DeleteFacility(c *fiber.Ctx) error {
	id := c.Params("id")

	var facility entity.Facility

	err := database.DB.Debug().First(&facility, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Product Not Found",
		})
	}

	if err := database.DB.Debug().Delete(&facility).Error; err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't Delete Facility",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": "Facility deleted successfully!",
	})
}