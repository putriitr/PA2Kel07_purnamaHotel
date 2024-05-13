package main

import (
	"log"
	database "room/Database"
	routes "room/Routes"

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

	routes.Routing(app)

	err := app.Listen(":8003")

	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}
}