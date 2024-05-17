package database

import (
	"fmt"
	"roombooking/Models/entity"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func Connection() {
	const connect = "root:hasansinaga1717@tcp(localhost)/service_roomBooking?charset=utf8&parseTime=True&loc=Local"
	dsn := connect
	db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})
	if err != nil {
		panic("Couldn't connect to database")
	}

	DB = db

	fmt.Println("Succesfully Conncet to Database")

	DB.AutoMigrate(&entity.RoomBooking{})
}