package entity

import (
	"time"
)

type Announcement struct{
	Title string `json:"title" gorm:"type:varchar(100)" validate:"required"`
	Content   string `json:"content" gorm:"type:varchar(100)" validate:"required,min=5"`
	Image string `json:"image" gorm:"type:varchar(100)" validate:"required"`
	CreatedAt time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt time.Time `json:"updated_at" gorm:"autoUpdatedTime" db:"updated_at"`
}