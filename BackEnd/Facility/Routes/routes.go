package routes

import (
	controllers "facility/Controllers"

	"github.com/gofiber/fiber/v2"
)

func SetUp(app *fiber.App) {
	facility := app.Group("/facility")
	facility.Get("/", controllers.GetAllFacility)
	facility.Get("/:id", controllers.GetFacilityByID)
	facility.Post("/create", controllers.CreateFacility)
	facility.Put("/update/:id", controllers.UpdateFacility)
	facility.Delete("/delete/:id", controllers.DeleteFacility)
}