package request 

type RequestRoomCategoryCreate struct{
	Name      string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
}

type RequestRoomCategoryUpdate struct{
	Name      string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Description string    `json:"description" gorm:"type:varchar(250)" validate:"required"`
}