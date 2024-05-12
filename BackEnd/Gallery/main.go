package main

import (
	database "gallery/Database"
	routes "gallery/Routes"
	"log"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
)

func main() {
	database.Connection()
	app := fiber.New()

	app.Use(cors.New(cors.Config{
		AllowCredentials: true,
		AllowOrigins:     "https://gofiber.io",
	}))

	routes.SetUp(app)

	err := app.Listen(":8080")

	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}
}