package controllers

import (
	"Manager/database"
	"Manager/models/entity"
	"Manager/models/request"
	"Manager/utils"
	"strconv"
	"time"

	"github.com/dgrijalva/jwt-go"
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

func Login(a *fiber.Ctx) error {
	input := new(request.LoginManager)

	if err := a.BodyParser(input); err != nil {
		return err
	}

	validation := validator.New()
	if err := validation.Struct(input); err != nil {
		return a.Status(400).JSON(fiber.Map{
			"status": "failed",
			"message": err.Error(),
		})
	}

	var manager entity.Manager

	result := database.DB.First(&manager, "username = ?", input.Username)

	if result.Error != nil {
		return a.Status(400).JSON(fiber.Map{
			"status": "failed",
			"message": "Username Not Found",
		})
	}

	checkPassword := utils.CheckPassword(input.Password, manager.Password)

	if !checkPassword {
		return a.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
			"status": "failed",
			"message": "Incorrect Password",
		})
		
	}

	claims := jwt.StandardClaims{
		Issuer: strconv.Itoa(int(manager.Id)),
		ExpiresAt: time.Now().Add(time.Hour * 2).Unix(),
	}

	tokens, err := utils.GenerateToken(&claims)

	if err != nil {
		return a.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
			"status": "failed",
			"message": "Error Generating Token",
		})
	}

	cookie := fiber.Cookie{
		Name: "jwt",
		Value: tokens,
		Expires: time.Now().Add(time.Hour * 2),
		HTTPOnly: true,
	}

	a.Cookie(&cookie)

	return a.JSON(fiber.Map{
		"status": "success",
		"message": manager,
		"token": tokens,
	})
}

func GetData(a *fiber.Ctx) error {
	cookie := a.Cookies("jwt")
	token, err := jwt.ParseWithClaims(cookie, &jwt.StandardClaims{}, func(t *jwt.Token) (interface{}, error) {
		return []byte(utils.Secret_Key), nil
	})

	if err != nil{
		return a.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
			"message": "unauthenticated",
		})
	}

	claims := token.Claims.(*jwt.StandardClaims)

	var manager entity.Manager

	errAdmin := database.DB.Where("id = ?", claims.Issuer).First(&manager).Error

	if errAdmin != nil {
		return a.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
			"message": "unauthenticated",
		})
	}

	fiber.Head(cookie)

	return a.JSON(fiber.Map{
		"admin": manager,
		"token": token,
	})
}

func Logout(a *fiber.Ctx) error {
	cookie := fiber.Cookie{
		Name: "jwt",
		Value: "",
		Expires: time.Now().Add(-time.Hour),
		HTTPOnly: true,
	}

	a.Cookie(&cookie)

	return a.JSON(fiber.Map{
		"message": "Logged out Successfully",
	})
}