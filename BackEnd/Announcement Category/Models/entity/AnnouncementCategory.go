package entity

import "time"

type AnnouncementCategory struct {
	Id        uint   `json:"id"`
	Name      string `json:"name" gorm:"type:varchar(100)" validate:"required,min=10"`
	CreatedAt time.Time `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt time.Time `json:"updated_at" gorm:"autoUpdatedTime" db:"updated_at"`
}