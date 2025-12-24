@echo off
title Orquestador EcoSystem
echo ==========================================
echo    INICIANDO ECOSISTEMA BARE METAL
echo ==========================================

:: 1. Iniciar API Gateway de Go
echo [2/3] Iniciando API Gateway (Go)...
timeout /t 3
start "API Gateway GO" cmd /k "cd api-gateway-go && go run main.go"

:: 2. Iniciar Servidor PHP
echo [3/3] Iniciando Panel Admin (PHP)...
timeout /t 2
start "Panel PHP" cmd /k "cd business-logic-php && php -S localhost:9000"

echo.
echo ==========================================
echo    SISTEMA CORRIENDO EXITOSAMENTE
echo    Dashboard: http://localhost:9000
echo ==========================================
pause