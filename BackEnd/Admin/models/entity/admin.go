package entity

import "time"

type Admin struct {
	Id        uint   `json:"id"`
	Username  string `json:"username" gorm:"type:varchar(255)" validate:"required,min=20"`
	Password  string `json:"password" gorm:"type:varchar(255)" validate:"required,min=10"`
	CreatedAt time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt time.Time  `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}