package main

import (
	"log"
	database "roomcategory/Database"
	routes "roomcategory/Routes"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
)

func main() {
	database.Connection()

	app := fiber.New()

	app.Use(cors.New(cors.Config{
		AllowCredentials: true,
		AllowOrigins: "https://gofiber.io",
	}))

	routes.Route(app)

	err := app.Listen(":8081")
	if err != nil{
		log.Fatalf("Failed to Listen: %v", err)
	}
}