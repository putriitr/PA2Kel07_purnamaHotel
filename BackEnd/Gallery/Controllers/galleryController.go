package controllers

import (
	database "gallery/Database"
	entity "gallery/Models/Entity"
	request "gallery/Models/Request"
	utils "gallery/Utils"
	"os"
	"path/filepath"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

var PathImageGallery = "./Public"

func init() {
	if _, err := os.Stat(PathImageGallery); os.IsNotExist(err) {
		os.Mkdir(PathImageGallery, os.ModePerm)
	}
}

func GetAllGallery(c *fiber.Ctx) error {
	var galeries []entity.Gallery

	result := database.DB.Find(&galeries)

	if len(galeries) == 0 {
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
		"message": galeries,
	})
}

func GetGalleryByID(c *fiber.Ctx) error {
	id := c.Params("id")

	var galeries entity.Gallery

	err := database.DB.First(&galeries, "id = ?", id).Error

	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Product Not Found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": galeries,
	})
}

func CreateGallery(c *fiber.Ctx) error {
	input := new(request.RequestGalleryCreate)

	// Parse body request into input struct
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
			"message": "image is required",
		})
	}

	// Generate image filename
	filename := utils.GenerateImageFile(input.Name, image.Filename)

	// Save image file
	if err := c.SaveFile(image, filepath.Join(PathImageGallery, filename)); err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't save file image",
		})
	}

	// Create Gallery entity
	galeries := entity.Gallery{
		Name:      input.Name,
		Description: input.Description,
		Image:    filename, // Save filename instead of input.image
	}

	// Save Gallery to database
	result := database.DB.Create(&galeries)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't create Gallery",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": galeries,
	})
}

func UpdateGallery(c *fiber.Ctx) error {
	id := c.Params("id")
	input := new(request.RequestGalleryUpdate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	var galeries entity.Gallery

	err := database.DB.First(&galeries, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}
	if input.Name != "" {
		galeries.Name = input.Name
	}
	if input.Description != "" {
		galeries.Description = input.Description
	}

	newImage, err := c.FormFile("image")
	if err == nil {
		if galeries.Image != "" {
			oldPath := filepath.Join(PathImageGallery, galeries.Image)
			os.Remove(oldPath)
		}

		newFileName := utils.GenerateImageFile(galeries.Name, newImage.Filename)
		if err := c.SaveFile(newImage, filepath.Join(PathImageGallery, newFileName)); err != nil {
			return err
		}

		galeries.Image = newFileName
	}

	result := database.DB.Save(&galeries)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't update Gallery",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": galeries,
	})
}

func DeleteGallery(c *fiber.Ctx) error {
	id := c.Params("id")

	var galeries entity.Gallery

	err := database.DB.Debug().First(&galeries, "id = ?", id).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Gallery Not Found",
		})
	}

	if err := database.DB.Debug().Delete(&galeries).Error; err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't Delete Gallery",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": "Gallery deleted successfully!",
	})
}