<?php

use Mockery;

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
        if ($isPasswordMatch) return 'Login success';
        return 'Invalid credentials';
    }
}

describe('StubbingTest', function () {
        test('Should return Invalid credentials', function () {
        // Dummy values
        // Expected values

        // Argument values to call the real method
        $isPasswordMatch = false;

        // Spies or mocks
        $authenticationService = mock(AuthenticationService::class);
        $authenticationService
            ->shouldReceive('isPasswordMatch')
            ->once()
            ->andReturn($isPasswordMatch);

        // Real method call (actual value)
        $authenticationController = new AuthenticationController($authenticationService);
        $response = $authenticationController->verify(Mockery::type('string'), Mockery::type('string'));

        // Return type and data type assertions or expectation
        expect($response)->toBe('Invalid credentials');

        // Spies and mocks return type assertions and method call verifications
        $authenticationService
            ->shouldHaveReceived('isPasswordMatch')
            ->once();
    });

    test('Should return Login success', function () {
        // Dummy values
        // Expected values

        // Argument values to call the real method
        $isPasswordMatch = true;

        // Spies or mocks
        $authenticationService = mock(AuthenticationService::class);
        $authenticationService
            ->shouldReceive('isPasswordMatch')
            ->andReturn($isPasswordMatch);

        // Real method call (actual value)
        $authenticationController = new AuthenticationController($authenticationService);
        $response = $authenticationController->verify(Mockery::type('string'), Mockery::type('string'));

        // Return type and data type assertions or expectation
        expect($response)->toBe('Login success');

        // Spies and mocks return type assertions and method call verifications
        $authenticationService
            ->shouldHaveReceived('isPasswordMatch')
            ->once();
    });
});
