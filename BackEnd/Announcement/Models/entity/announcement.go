package entity

import (
	"time"
)

type Announcement struct {
	Id         uint      `json:"id"`
	Title      string    `json:"title" gorm:"type:varchar(100)" validate:"required"`
	Content    string    `json:"content" gorm:"type:varchar(100)" validate:"required,min=5"`
	Image      string    `json:"image" gorm:"type:varchar(100)" validate:"required"`
	CategoryID uint      `json:"category_id"`
	CreatedAt  time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt  time.Time `json:"updated_at" gorm:"autoUpdatedTime" db:"updated_at"`
}

type AnnouncementCategory struct {
	Id          uint      `json:"id"`
	Name        string    `json:"name" gorm:"type:varchar(100)" validate:"required,min=10"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
	CreatedAt   time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt   time.Time `json:"updated_at" gorm:"autoUpdatedTime" db:"updated_at"`
}
