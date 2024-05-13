package main

import (
	"log"
	database "user/Database"
	routes "user/Routes"

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

	err := app.Listen(":8084")
	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}
}