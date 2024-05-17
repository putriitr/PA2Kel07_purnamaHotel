package routes

import (
	controllers "user/Controllers"
	middleware "user/Middleware"

	"github.com/gofiber/fiber/v2"
)

func Routing(app *fiber.App) {
	user := app.Group("user")
	user.Post("/register", controllers.UserRegister)
	user.Post("/login", controllers.UserLogin)
	user.Use(middleware.Middleware())
	user.Get("/profile/:id", controllers.GetProfileUser)
	user.Post("/logout", controllers.UserLogout)
}
