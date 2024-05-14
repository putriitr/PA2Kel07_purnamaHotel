package main

import (
	"admin/database"
	"admin/database/migration"
	"admin/routes"
	"log"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
)

func main() {
	database.Connect()

	migration.Migration()

	//seeders.DataAdmin()

	app := fiber.New()

	app.Use(cors.New(cors.Config{
		AllowCredentials: true,
		AllowOrigins: "https://gofiber.io",
	}))

	routes.AdminRoute(app)

	err := app.Listen(":8000")

	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}
}