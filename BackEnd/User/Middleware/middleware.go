package middleware

import (
	"strings"
	"time"
	database "user/Database"
	entity "user/Models/Entity"
	utils "user/Utils"

	"github.com/dgrijalva/jwt-go"
	"github.com/gofiber/fiber/v2"
)

func Middleware() fiber.Handler {
	return func(c *fiber.Ctx) error {
		cookie := c.Cookies("jwt")
		if cookie == "" {
			return c.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
				"message": "unauthenticated",
			})
		}

		tokenString := strings.Replace(cookie, "jwt", "", 1)
		token, err := jwt.ParseWithClaims(tokenString, &jwt.StandardClaims{}, func(t *jwt.Token) (interface{}, error) {
			return []byte(utils.Secret_Key), nil
		})

		claims := token.Claims.(*jwt.StandardClaims)

		claims.ExpiresAt = time.Now().Add(time.Hour * 2).Unix()
		newToken := jwt.NewWithClaims(jwt.SigningMethodHS256, claims)
		tokenString, err = newToken.SignedString([]byte(utils.Secret_Key))
		if err != nil {
			return c.Status(fiber.StatusInternalServerError).JSON(fiber.Map{
				"message": "error refreshing token",
			})
		}

		cookie = tokenString
		c.Cookie(&fiber.Cookie{
			Name:     "jwt",
			Value:    cookie,
			Expires:  time.Now().Add(time.Hour * 2),
			HTTPOnly: true,
		})

		var user entity.User
		database.DB.Where("id = ?", claims.Issuer).First(&user)
		c.Locals("user", user)
		return c.Next()
	}
}