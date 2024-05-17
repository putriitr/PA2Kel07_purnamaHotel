package controllers

import (
	"encoding/json"
	"fmt"
	"net/http"
	"roombooking/Models/entity"
	"roombooking/Models/request"
	"roombooking/database"
	"strconv"
	"time"

	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
)

func getRoomID(roomID int) (*entity.Room, error) {
	resp, err := http.Get(fmt.Sprintf("http://127.0.0.1:8003/room/%d", roomID))
	if err != nil {
		return nil, fmt.Errorf("failed to make HTTP request: %v", err)
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		return nil, fmt.Errorf("HTTP request room failed with status code: %d", resp.StatusCode)
	}

	var room entity.Room
	if err := json.NewDecoder(resp.Body).Decode(&room); err != nil {
		return nil, fmt.Errorf("failed to decode JSON response: %v", err)
	}

	return &room, nil
}

func getUserID(token string, UserID int) (*entity.User, error) {
	client := http.Client{
		Timeout: time.Second * 10,
	}

	req, err := http.NewRequest(http.MethodGet, fmt.Sprintf("http://127.0.0.1:8084/user/profile/%d", UserID), nil)
	if err != nil {
		return nil, fmt.Errorf("failed to make HTTP request: %v", err)
	}
	req.AddCookie(&http.Cookie{Name: "jwt", Value: token})

	resp, err := client.Do(req)
	if err != nil {
		return nil, fmt.Errorf("failed to make HTTP request: %v", err)
	}

	if resp.StatusCode != http.StatusOK {
		return nil, fmt.Errorf("HTTP request user failed with status code: %d", resp.StatusCode)
	}
	defer resp.Body.Close()

	var user entity.User
	if err := json.NewDecoder(resp.Body).Decode(&user); err != nil {
		return nil, fmt.Errorf("failed to decode JSON response: %v", err)
	}

	return &user, nil
}

func GetAllRoomBooking(c *fiber.Ctx) error {
	var roombookings []entity.RoomBooking

	result := database.DB.Find(&roombookings)

	if len(roombookings) == 0 {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}

	if result.Error != nil {
		return c.Status(404).JSON(fiber.Map{
			"status":  "failed",
			"message": "Not Found",
		})
	}

	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": roombookings,
	})
}

func CreateRoomBooking(c *fiber.Ctx) error {
	input := new(request.RequestRoomBookingCreate)

	if err := c.BodyParser(input); err != nil {
		return err
	}

	validation := validator.New()
	if err := validation.Struct(input); err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "Failed",
			"message": err.Error(),
		})
	}

	RoomID, err := strconv.Atoi(c.FormValue("room_id"))
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "RoomID is required and must be an integer",
		})
	}

	room, err := getRoomID(RoomID)
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	room.Id = uint(RoomID)

	UserID, err := strconv.Atoi(c.FormValue("user_id"))
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "UserID is required and must be an integer",
		})
	}

	cookie := c.Cookies("jwt")
	if cookie == "" {
		return c.Status(fiber.StatusUnauthorized).JSON(fiber.Map{
			"message": "unauthenticated",
		})
	}

	user, err := getUserID(cookie, UserID)
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": err.Error(),
		})
	}

	user.Id = uint(UserID)

	checkIn, err := time.Parse("2006-01-02", input.CheckIn)
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "CheckIn date is invalid. Format should be YYYY-MM-DD",
		})
	}

	checkOut, err := time.Parse("2006-01-02", input.CheckOut)
	if err != nil {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "CheckOut date is invalid. Format should be YYYY-MM-DD",
		})
	}

	if !checkOut.After(checkIn) {
		return c.Status(400).JSON(fiber.Map{
			"status":  "failed",
			"message": "CheckOut date must be after CheckIn date",
		})
	}

	duration := checkOut.Sub(checkIn).Hours() / 24

	// Mengonversi harga ruangan ke float64
	price, err := strconv.ParseFloat(room.Price, 64)
	if err != nil {
		fmt.Println("Error converting room price to float:", err)
		// Handle error
	}

	total := price * duration

	// Membuat objek RoomBooking
	roombooking := entity.RoomBooking{
		CheckIn:  checkIn.Format("2006-01-02"),
		CheckOut: checkOut.Format("2006-01-02"),
		Status:   "waiting",
		Total:    total,
		UserID:   uint(UserID),
		RoomID:   uint(RoomID),
	}

	// Menyimpan data ke database
	if err := database.DB.Create(&roombooking).Error; err != nil {
		return c.Status(500).JSON(fiber.Map{
			"status":  "failed",
			"message": "Failed to create room booking",
		})
	}

	// Mengembalikan respons sukses
	return c.Status(200).JSON(fiber.Map{
		"status":  "success",
		"message": roombooking,
	})

}
