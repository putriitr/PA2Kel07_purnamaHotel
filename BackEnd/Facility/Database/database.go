package database

import (
	entity "facility/Models/Entity"
	"fmt"

	"gorm.io/gorm"
	"gorm.io/driver/mysql"
)

var DB *gorm.DB

func Connection() {
	const connect = "root:hasansinaga1717@tcp(localhost)/service_facility?charset=utf8&parseTime=True&loc=Local"
	dsn := connect
	db, err := gorm.Open(mysql.Open(dsn), &gorm.Config{})
	if err != nil {
		panic("Couldn't connect to database")
	}

	DB = db

	fmt.Println("Succesfully Conncet to Database")

	DB.AutoMigrate(&entity.Facility{})
}