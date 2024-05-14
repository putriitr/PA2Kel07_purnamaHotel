package migration

import (
	"Manager/database"
	"Manager/models/entity"
	"fmt"
	"log"
)

func Migration() {

	err := database.DB.AutoMigrate(&entity.Manager{})

	if err != nil {
		log.Println(err)
	}

	fmt.Println("Database is already migrated")

}