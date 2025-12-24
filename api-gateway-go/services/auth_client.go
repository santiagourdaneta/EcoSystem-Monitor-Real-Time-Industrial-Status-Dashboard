package services

import (
	"context"
	"os"
	"time"

	pb "api-go/proto"
	"google.golang.org/grpc"
	"google.golang.org/grpc/credentials/insecure"
)

// AuthServiceClient encapsula la comunicación con Rust
func CallAuthService(username, password string) (*pb.LoginResponse, error) {
	addr := os.Getenv("RUST_GRPC_ADDR")
	conn, err := grpc.Dial("127.0.0.1:50051", grpc.WithInsecure())
	if err != nil {
		return nil, err
	}
	defer conn.Close()

	client := pb.NewAuthServiceClient(conn)
	ctx, cancel := context.WithTimeout(context.Background(), time.Second)
	defer cancel()

	return client.Login(ctx, &pb.LoginRequest{
		Username: username,
		Password: password,
	})
}

