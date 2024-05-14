package seeders

import (
	"Manager/database"
	"Manager/models/entity"
	"Manager/utils"
	"fmt"
	"log"
)

func DataManager() {
	password, err := utils.GeneratePassword("manager123")
	if err != nil {
		log.Fatalf(err.Error())
	}

	manager := &entity.Manager{
		Username: "manager",
		Password: password,
	}

	if err := database.DB.Create(&manager); err != nil {
		log.Fatalf("Failed to create manager: %v", err)
	}

	fmt.Println("Data Successfully")

}