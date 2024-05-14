package routes

import (
	controllers "admin/Controllers"

	"github.com/gofiber/fiber/v2"
)

func AdminRoute(app *fiber.App) {
	routes := app.Group("/Admin")
	routes.Post("/login", controllers.Login)
    routes.Get("/GetData", controllers.GetData)
	routes.Post("/Logout", controllers.Logout)
}