package routes

import (
	controllers "gallery/Controllers"

	"github.com/gofiber/fiber/v2"
)

func SetUp(app *fiber.App) {
	gallery := app.Group("/gallery")
	gallery.Get("/",controllers.GetAllGallery)
	gallery.Get("/:id", controllers.GetGalleryByID)
	gallery.Post("/create", controllers.CreateGallery)
	gallery.Put("/update/:id", controllers.UpdateGallery)
	gallery.Delete("/delete/:id", controllers.DeleteGallery)
}