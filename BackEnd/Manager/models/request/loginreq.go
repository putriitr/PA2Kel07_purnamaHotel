package request

type LoginManager struct {
	Username  string    `json:"username" gorm:"type:varchar(255)" validate:"required"`
	Password  string    `json:"password" gorm:"type:varchar(255)" validate:"required"`
}