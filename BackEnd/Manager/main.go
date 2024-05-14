package main

import (
	"Manager/database"
	"Manager/database/migration"
	"Manager/routes"
	"log"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
)

func main()  {
	database.Connect()

	migration.Migration()

	app := fiber.New()

	app.Use(cors.New(cors.Config{
		AllowCredentials: true,
		AllowOrigins: "https://gofiber.io",
	}))

	routes.AdminRoute(app)

	err := app.Listen(":8005")

	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}
}