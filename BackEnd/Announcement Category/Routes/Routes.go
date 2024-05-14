package routes

import (
	controllers "Announcement_Category/Controllers"

	"github.com/gofiber/fiber/v2"
)

func Routes(app *fiber.App) {
	routes := app.Group("announcementCategory")
	routes.Get("/", controllers.GetAnnouncementCategories)
	routes.Post("/create", controllers.CreateAnnouncementCategory)
	routes.Get("/:id", controllers.GetAnnouncementCategoryById)
	routes.Put("/update/:id", controllers.UpdateAnnouncementCategory)
	routes.Delete("/delete/:id", controllers.DeleteAnnouncementCategory)
}