package request

type RequestUserRegister struct{
	Name      string    `json:"name" gorm:"type:varchar(255)" validate:"required"`
	Phone     string    `json:"phone" gorm:"type:varchar(255)" validate:"required"`
	Email string `json:"email" gorm:"type:varchar(255)" validate:"required"`
	Username  string    `json:"username" gorm:"type:varchar(255)" validate:"required,min=5"`
	Password  string    `json:"password" gorm:"type:varchar(255)" validate:"required,min=5"`
}

type RequestUserLogin struct{
	Username  string    `json:"username" gorm:"type:varchar(255)" validate:"required,min=5"`
	Password  string    `json:"password" gorm:"type:varchar(255)" validate:"required,min=5"`
}