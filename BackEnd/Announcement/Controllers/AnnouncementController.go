package controllers

import (
	database "Announcement/Database"
	"Announcement/Models/entity"
	"Announcement/Models/response"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
) 

func Announcement(a *fiber.Ctx) error {
    var Announcement []entity.Announcement

	result := database.DB.Debug().Find(&Announcement)

	if len(Announcement) == 0 {
		return a.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not Found",
		})
	}

	if result.Error != nil {
		return a.Status(500).JSON(fiber.Map{
			"status": "Failed",
			"message": "Couldn't find data",
		})	
	}

	return a.Status(200).JSON(fiber.Map{
		"status": "success",
		"message": Announcement,
	})
}

func CreateAnnouncement(a *fiber.Ctx) error  {
	input := new(response.RequestCreateAnnouncement)

	if err := a.BodyParser(input); err != nil {
		return err
	}

	validation := validator.New()
	if err := validation.Struct(input); err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status" : "Failed",
			"message" : err.Error(),
		})
	}

	Announcement := entity.Announcement{
		Title: input.Title,
		Content: input.Content,
		Image: input.Image,
	}

	err := database.DB.Create(&Announcement).Error
	if err != nil {
		return a.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't to Create Data",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status" : "success",
		"message" : Announcement,
	})
}

func GetAnnouncementByTitle(a *fiber.Ctx) error  {
	Title := a.Params("Title")

	var Announcement entity.Announcement

	err := database.DB.Where("titler = ?", Title).First(&Announcement).Error

	if err != nil {
		return a.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not Found",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status" : "success",
		"message" : Announcement,
	})
}

func UpdateAnnouncement(a *fiber.Ctx) error  {
	judul := a.Params("title")
	input := new(response.RequestUpdateAnnouncement)

	if err := a.BodyParser(input); err != nil {
		return err
	}

	var Announcement entity.Announcement

	err := database.DB.Where("title = ?", judul).First(&Announcement).Error

	if err != nil {
		return a.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not Found",
		})
	}

	if input.Title != "" {
		Announcement.Title = input.Title
	}

	if input.Content != "" {
		Announcement.Content = input.Content
	}

	if input.Image != "" {
		Announcement.Image = input.Image
	}

	err = database.DB.Save(&Announcement).Error
	if err != nil {
		return a.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't to Update Data",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status" : "success",
		"message" : Announcement,
	})
}

func DeleteAnnouncement(a *fiber.Ctx) error  {
	Title := a.Params("title")

	var Announcement entity.Announcement

	err := database.DB.Where("title = ?", Title).First(&Announcement).Error

	if err != nil {
		return a.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not Found",
		})
	}

	if err := database.DB.Debug().Delete(&Announcement).Error; err != nil {
		return a.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't to Delete Data",
		})
	}

	return a.Status(200).JSON(fiber.Map{
		"status" : "success",
		"message" : "Deleted Successfully",
	})
}