package seeders

import (
	"admin/database"
	"admin/models/entity"
	"admin/utils"
	"fmt"
	"log"
)

func DataAdmin() {
	password, err := utils.GeneratePassword("admin1")
	if err != nil {
		log.Fatalf(err.Error())
	}

	admin := &entity.Admin{
		Username: "admin",
		Password: password,
	}

	if err := database.DB.Create(&admin); err != nil {
		log.Fatalf("Failed to create admin: %v", err)
	}

	fmt.Println("Data Successfully")

}