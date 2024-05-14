package response

type RequestCreateAnnouncement struct{
	Title string `json:"judul" gorm:"type:varchar(100)" validate:"required"`
	Content  string `json:"isi" gorm:"type:varchar(100)" validate:"required,min=5"`
	Image string `json:"image" gorm:"type:varchar(100)" validate:"required"`
}

type RequestUpdateAnnouncement struct {
	Title string `json:"judul" gorm:"type:varchar(100)" validate:"required"`
	Content   string `json:"isi" gorm:"type:varchar(100)" validate:"required,min=5"`
	Image string `json:"image" gorm:"type:varchar(100)" validate:"required"`
}