package entity

import "time"

type Room struct {
	Id         uint      `json:"id"`
	Name       string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Facility   string    `json:"facility" gorm:"type:varchar(250)" validate:"required"`
	Capacity   int       `json:"capacity" gorm:"type:int" validate:"required"`
	Price      float64    `json:"price" validate:"required"`
	Image      string    `json:"image" gorm:"type:varchar(50)" validate:"required"`
	CategoryID uint      `json:"category_id"`
	CreatedAt  time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt  time.Time `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}

type RoomCategory struct {
	Id          uint      `json:"id"`
	Name        string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
	CreatedAt   time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt   time.Time `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}
