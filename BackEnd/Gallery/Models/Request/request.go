package request

type RequestGalleryCreate struct{
	Name        string    `json:"name" gorm:"type:varchar(50);index:idx_nm,unique" validate:"required"`
	Description string    `json:"description" gorm:"type:text" validate:"required"`
}

type RequestGalleryUpdate struct{
	Name  string    `json:"name" gorm:"type:varchar(50);index:idx_nm,unique" validate:"required"`
	Description string    `json:"description" gorm:"type:text" validate:"required"`
}