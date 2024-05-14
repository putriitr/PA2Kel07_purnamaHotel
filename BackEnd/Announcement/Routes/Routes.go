package routes

import (
	controllers "Announcement/Controllers"

	"github.com/gofiber/fiber/v2"
)

func Routes(app *fiber.App) {
	routes := app.Group("Announcement")
	routes.Get("/", controllers.Announcement)
	routes.Post("/create", controllers.CreateAnnouncement)
	routes.Get("/:title", controllers.GetAnnouncementByTitle)
	routes.Put("/update/:title", controllers.UpdateAnnouncement)
	routes.Delete("/delete/:title", controllers.DeleteAnnouncement)
}