package database

import (
	"fmt"
	"Announcement_Category/Models/entity"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB 

func Connect()  {
	const con = "root@tcp(localhost)/service_announcementcategory?charset=utf8&parseTime=True&loc=Local"
	dsn := con
	db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})

	if err != nil {
		panic("Database not Connected")
	}

	DB = db

	fmt.Println("Database Connected")

	DB.AutoMigrate(&entity.AnnouncementCategory{})
}