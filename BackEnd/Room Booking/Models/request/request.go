package request

type RequestRoomBookingCreate struct {
	CheckIn  string `json:"checkin" gorm:"column:check_in" db:"check_in" validate:"required"`
	CheckOut string `json:"checkout" gorm:"column:check_out" db:"check_out" validate:"required"`
}
