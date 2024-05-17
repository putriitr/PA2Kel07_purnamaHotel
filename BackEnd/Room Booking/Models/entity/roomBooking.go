package entity

import "time"

type RoomBooking struct {
    Id        uint      `json:"id"`
    UserID    uint      `json:"user_id"`
    RoomID    uint      `json:"room_id"`
    Status    string    `json:"status" gorm:"type:varchar(255)"`
    CheckIn   string    `json:"checkin" gorm:"column:check_in" db:"check_in"`
    CheckOut  string    `json:"checkout" gorm:"column:check_out" db:"check_out"`
    Total     float64   `json:"total"`
    CreatedAt time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
    UpdatedAt time.Time `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}

type Room struct {
	Id        uint      `json:"id"`
	Name      string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Facility  string    `json:"facility" gorm:"type:varchar(250)" validate:"required"`
	Capacity  int       `json:"capacity" gorm:"type:int" validate:"required"`
	Price     string    `json:"price" validate:"required"`
	Image     string    `json:"image" gorm:"type:varchar(50)" validate:"required"`
	CreatedAt time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt time.Time `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}

type User struct {
	Id        uint      `json:"id"`
	Name      string    `json:"name" gorm:"type:varchar(255)" validate:"required"`
	Phone     string    `json:"phone" gorm:"type:varchar(255)" validate:"required"`
	Email     string    `json:"email" gorm:"type:varchar(255)" validate:"required"`
	Username  string    `json:"username" gorm:"type:varchar(255)" validate:"required,min=5"`
	Password  string    `json:"password" gorm:"type:varchar(255)" validate:"required,min=5"`
	CreatedAt time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt time.Time `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}
