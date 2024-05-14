package utils

import (
	"golang.org/x/crypto/bcrypt"
)

func GeneratePassword(password string) (string, error) {
	hash, err := bcrypt.GenerateFromPassword([]byte(password), 14)
	if err != nil {
		return "", err
	}
	return string(hash), nil
}

func CheckPassword(password, generatepw string) bool  {
	err := bcrypt.CompareHashAndPassword([]byte(generatepw), []byte(password))
	return err == nil
}