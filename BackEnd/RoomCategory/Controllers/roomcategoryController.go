package controllers

import (
	database "roomcategory/Database"
	"roomcategory/Models/entity"
	"roomcategory/Models/request"

	"github.com/gofiber/fiber/v2"
	"github.com/go-playground/validator/v10"
)

func GetAllRoomCategory(c *fiber.Ctx) error {
	var roomcategory[]entity.RoomCategory

	result := database.DB.Debug().Find(&roomcategory)
	if len(roomcategory) == 0 {
		return c.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not Found",
		})
	}

	if result.Error != nil{
		return c.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't Find Data",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status" : "succes",
		"message" : roomcategory,
	})
}

func GetRoomCategoryById(c *fiber.Ctx) error{
	id := c.Params("id")

	var roomcategories entity.RoomCategory

	err := database.DB.Where("id = ?", id).First(&roomcategories).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status" : "succes",
			"message" : "Not found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status" : "succes",
		"message" : roomcategories,
	})
}

func CreateRoomCategory(c *fiber.Ctx) error  {
	input := new(request.RequestRoomCategoryCreate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	validation := validator.New()
	if err := validation.Struct(input); err!= nil{
		return c.Status(400).JSON(fiber.Map{
			"status" : "Failed",
			"message" : err.Error(),
		})
	}
	
	roomcategories := entity.RoomCategory{
		Name: input.Name,
		Description: input.Description,
	}
	
	err := database.DB.Create(&roomcategories).Error
	if err != nil{
		return c.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't to Create data",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status" : "succes",
		"message" : roomcategories,
	})
}

func UpdateRoomCategory(c *fiber.Ctx) error {
	id := c.Params("id")
	input := new(request.RequestRoomCategoryUpdate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	var roomcategories entity.RoomCategory
	err := database.DB.Where("id = ?", id).First(&roomcategories).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not found",
		})
	}
	
	if input.Name != ""{
		roomcategories.Name = input.Name
	}
	if input.Description != ""{
		roomcategories.Description = input.Description
	}

	err = database.DB.Save(&roomcategories).Error
	if err != nil{
		return c.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't Update Data",
		})
	}
	return c.Status(200).JSON(fiber.Map{
		"status" : "succes",
		"message" : roomcategories,
	})
}

func DeleteRoomCategory(c *fiber.Ctx) error  {
	id := c.Params("id")

	var roomcategories entity.RoomCategory
	err := database.DB.Where("id = ?", id).First(&roomcategories).Error
	if err != nil {
		return c.Status(404).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Not found",
		})
	}

	if err := database.DB.Debug().Delete(&roomcategories).Error; err != nil{
		return c.Status(500).JSON(fiber.Map{
			"status" : "Failed",
			"message" : "Couldn't to Delete Data",
		})
	}
	return c.Status(200).JSON(fiber.Map{
		"status" : "succes",
		"message" : "Deleted Succesfully",
	})
}