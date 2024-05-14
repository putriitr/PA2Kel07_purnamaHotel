package routes

import (
	controllers "Manager/Controllers"

	"github.com/gofiber/fiber/v2"
)

func AdminRoute(app *fiber.App) {
	routes := app.Group("/Manager")
	routes.Post("/login", controllers.Login)
	routes.Get("/GetData", controllers.GetData)
	routes.Post("/Logout", controllers.Logout)
}