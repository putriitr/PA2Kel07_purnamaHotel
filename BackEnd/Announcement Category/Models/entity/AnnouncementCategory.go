package entity

import "time"

type AnnouncementCategory struct {
	Id        uint      `json:"id"`
	Name      string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
	CreatedAt time.Time  `json:"created_at" gorm:"autoCreateTime" db:"created_at"`
	UpdatedAt time.Time `json:"updated_at" gorm:"autoUpdateTime" db:"updated_at"`
}