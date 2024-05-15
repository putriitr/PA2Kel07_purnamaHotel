package routes

import (
	controllers "Announcement/Controllers"

	"github.com/gofiber/fiber/v2"
)

func Routes(app *fiber.App) {
	routes := app.Group("Announcement")
	routes.Get("/", controllers.Announcement)
	routes.Post("/create", controllers.CreateAnnouncement)
	routes.Get("/:id", controllers.GetAnnouncementByID)
	routes.Put("/update/:id", controllers.UpdateAnnouncement)
	routes.Delete("/delete/:id", controllers.DeleteAnnouncement)
}