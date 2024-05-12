package routes

import (
	controllers "roomcategory/Controllers"

	"github.com/gofiber/fiber/v2"
)

func Route(app *fiber.App) {
	r := app.Group("roomCategory")
	r.Get("/", controllers.GetAllRoomCategory)
	r.Post("/create", controllers.CreateRoomCategory)
	r.Get("/:id",controllers.GetRoomCategoryById)
	r.Put("/update/:id",controllers.UpdateRoomCategory)
	r.Delete("/delete/:id",controllers.DeleteRoomCategory)
}