package response

type RequestCreateAnnouncementCategory struct{
	Id        uint   `json:"id"`
	Name      string `json:"name" gorm:"type:varchar(100)" validate:"required,min=10"`
}

type RequestUpdateAnnouncementCategory struct {
	Id        uint   `json:"id"`
	Name      string `json:"name" gorm:"type:varchar(100)" validate:"required,min=10"`
}