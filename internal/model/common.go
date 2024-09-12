package model

import (
	"database/sql"
	"database/sql/driver"
	"encoding/json"
	"time"
)

type Common struct {
	ID        int       `json:"ID" gorm:"primaryKey;autoIncrement;type:uint"`
	CreatedAt time.Time `json:"created_at" gorm:"<-;autoCreateTime;type:DATETIME;not null;default:CURRENT_TIMESTAMP"`
	UpdatedAt time.Time `json:"updated_at" gorm:"<-;autoUpdateTime;type:DATETIME;not null;default:CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"`
	DeletedAt NullTime  `gorm:"index" json:"deleted_at"`
}

type NullTime struct {
	Time  time.Time
	Valid bool // Valid is true if Time is not NULL
	// gorm.Model
}

// Scan implements the Scanner interface.
func (n *NullTime) Scan(value interface{}) error {
	return (*sql.NullTime)(n).Scan(value)
}

// Value implements the driver Valuer interface.
func (n NullTime) Value() (driver.Value, error) {
	if !n.Valid {
		return nil, nil
	}
	return n.Time, nil
}

func (n NullTime) MarshalJSON() ([]byte, error) {
	if n.Valid {
		return json.Marshal(n.Time)
	}
	return json.Marshal(nil)
}

func (n *NullTime) UnmarshalJSON(b []byte) error {
	if string(b) == "null" {
		n.Valid = false
		return nil
	}
	err := json.Unmarshal(b, &n.Time)
	if err == nil {
		n.Valid = true
	}
	return err
}
