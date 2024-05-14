package main

import (
	database "Announcement_Category/Database"
	routes "Announcement_Category/Routes"
	"log"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
)

func main() {
	database.Connect()

	app := fiber.New()

	app.Use(cors.New(cors.Config{
		AllowCredentials: true,
		AllowOrigins:     "https://gofiber.io",
	}))

	routes.Routes(app)

	err := app.Listen(":8001")
	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}
}