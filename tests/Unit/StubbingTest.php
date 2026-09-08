<?php

interface AuthenticationService
{
    public function isPasswordMatch(string $hashPassword, string $rawPassword): bool;
}

class AuthenticationServiceImpl implements AuthenticationService
{
    public function isPasswordMatch(string $hashPassword, string $rawPassword): bool
    {
        return $hashPassword === $rawPassword;
    }
}

class AuthenticationController {
    public function __construct(private AuthenticationService $authenticationService)
    { }

    public function verify(string $hashPassword, string $rawPassword): string {
        $isPasswordMatch = $this->authenticationService->isPasswordMatch($hashPassword, $rawPassword);
        if ($isPasswordMatch) return 'Login Success';
        return 'Invalid Credentials';
    }
}

test('example', function () {
    // Test implementation here
});
