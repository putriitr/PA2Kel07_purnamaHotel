package controllers

import (
	"strconv"
	"time"
	database "user/Database"
	entity "user/Models/Entity"
	request "user/Models/Request"
	utils "user/Utils"

	"github.com/dgrijalva/jwt-go"
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

func UserRegister(c *fiber.Ctx) error {
	input := new(request.RequestUserRegister)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	validate := validator.New()
	if err := validate.Struct(input); err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	password, err := utils.GeneratePassword(input.Password)
	if err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Failed to generate password",
		})
	}

	input.Password = password

	users := entity.User{
		Name:     input.Name,
		Phone:    input.Phone,
		Email:    input.Email,
		Username: input.Username,
		Password: password,
	}
	result := database.DB.Create(&users)
	if result.Error != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Can't to create user account",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": users,
	})
}

func UserLogin(c *fiber.Ctx) error {
	input := new(request.RequestUserLogin)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	validate := validator.New()
	if err := validate.Struct(input); err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	var user entity.User

	result := database.DB.First(&user, "username = ?", input.Username)
	if result.Error != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Username Not Found",
		})
	}

	password := utils.CheckPassword(input.Password, user.Password)

	if !password {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "Inccorrect Password",
		})
	}

	claims := jwt.StandardClaims{
		Issuer:    strconv.Itoa(int(user.Id)),
		ExpiresAt: time.Now().Add(time.Hour * 2).Unix(),
	}

	token, err := utils.GenerateToken(&claims)
	if err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Error Generating Token",
		})
	}
	cookie := fiber.Cookie{
		Name:     "jwt",
		Value:    token,
		Expires:  time.Now().Add(time.Hour * 2),
		HTTPOnly: true,
	}

	c.Cookie(&cookie)

	return c.JSON(fiber.Map{
		"status":  "success",
		"message": user,
		"token":   token,
	})
}

func GetProfileUser(c *fiber.Ctx) error {
	id := c.Params("id")
	user := c.Locals("user").(entity.User)

	err := database.DB.First(&user, "id= ?", id).Error
	if err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}
	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": user,
	})
}

func UserLogout(c *fiber.Ctx) error {
	cookie := fiber.Cookie{
		Name:     "jwt",
		Value:    "",
		Expires:  time.Now().Add(-time.Hour),
		HTTPOnly: true,
	}

	c.Cookie(&cookie)

	c.Locals("user", nil)

	return c.JSON(fiber.Map{
		"status":  "success",
		"message": "Logout Successfully",
	})
}
