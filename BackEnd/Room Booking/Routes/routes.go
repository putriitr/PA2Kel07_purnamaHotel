package routes

import (
	controllers "roombooking/Controllers"

	"github.com/gofiber/fiber/v2"
)

func Routing(app *fiber.App) {
	booking := app.Group("roombooking")
	booking.Get("/", controllers.GetAllRoomBooking)
	booking.Post("/create", controllers.CreateRoomBooking)
}
