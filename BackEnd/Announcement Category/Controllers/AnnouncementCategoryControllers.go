package controllers

import (
	database "Announcement_Category/Database"
	"Announcement_Category/Models/entity"
	"Announcement_Category/Models/response"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

func GetAnnouncementCategories(c *fiber.Ctx) error {
	var announcementCategories []entity.AnnouncementCategory

	result := database.DB.Debug().Find(&announcementCategories)

	if len(announcementCategories) == 0 {
		return c.Status(404).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Not Found",
		})
	}

	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Couldn't find data",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": announcementCategories,
	})
}

func CreateAnnouncementCategory(c *fiber.Ctx) error {
	input := new(response.RequestCreateAnnouncementCategory)

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

	announcementCategory := entity.AnnouncementCategory{
		Name:        input.Name,
		Description: input.Description,
	}

	err := database.DB.Create(&announcementCategory).Error
	if err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Couldn't create data",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": announcementCategory,
	})
}

func GetAnnouncementCategoryById(c *fiber.Ctx) error {
	id := c.Params("id")

	var announcementCategories entity.AnnouncementCategory

	err := database.DB.Where("id = ?", id).First(&announcementCategories).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "succes",
			"message": "Not found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "succes",
		"message": announcementCategories,
	})
}

func UpdateAnnouncementCategory(c *fiber.Ctx) error {
	id := c.Params("id")
	input := new(response.RequestUpdateAnnouncementCategory)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	var announcementCategory entity.AnnouncementCategory

	err := database.DB.Where("id = ?", id).First(&announcementCategory).Error

	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Not Found",
		})
	}

	if input.Description != "" {
		announcementCategory.Description = input.Description
	}

	if input.Name != "" {
		announcementCategory.Name = input.Name
	}

	err = database.DB.Save(&announcementCategory).Error
	if err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Couldn't update data",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": announcementCategory,
	})
}

func DeleteAnnouncementCategory(c *fiber.Ctx) error {
	id := c.Params("id")

	var announcementCategory entity.AnnouncementCategory

	err := database.DB.Where("id = ?", id).First(&announcementCategory).Error

	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Not Found",
		})
	}

	if err := database.DB.Debug().Delete(&announcementCategory).Error; err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "Failed",
			"message": "Couldn't delete data",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": "Deleted Successfully",
	})
}
