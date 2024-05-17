package request

type RequestRoomCreate struct{
	Name       string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Facility string `json:"facility" gorm:"type:varchar(250)" validate:"required"`
	Capacity int `json:"capacity" gorm:"type:int" validate:"required"`
	Price      float64    `json:"price" validate:"required"`
	CategoryID uint      `json:"category_id"`
}

type RequestRoomUpdate struct{
	Name       string    `json:"name" gorm:"type:varchar(50)" validate:"required"`
	Facility string `json:"facility" gorm:"type:varchar(250)" validate:"required"`
	Capacity int `json:"capacity" gorm:"type:int" validate:"required"`
	Price      float64    `json:"price" validate:"required"`
	CategoryID uint      `json:"category_id"`
}