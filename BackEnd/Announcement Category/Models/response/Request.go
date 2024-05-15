package response

type RequestCreateAnnouncementCategory struct{
	Name      string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
}

type RequestUpdateAnnouncementCategory struct {
	Name      string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
}