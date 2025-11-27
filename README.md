
## Rental Chat Assistant

This project now ships with an AI assistant that answers housing rental questions by grounding ChatGPT responses in first-party property and infrastructure data.

### Quick start

1. Install dependencies and copy `.env` as usual.
2. Configure the following environment variables with your OpenAI credentials:
   - `OPENAI_API_KEY`
   - `OPENAI_ORGANIZATION` (optional)
   - `OPENAI_RENTAL_MODEL` (defaults to `gpt-4o-mini`)
3. Run the database migrations and demo seeders:

   ```bash
   php artisan migrate --seed
   ```

4. Start the app (`php artisan serve`) and visit `/rental-chat` for a lightweight UI, or call the API directly:

   ```bash
   curl -X POST http://localhost/api/rental-chat \
     -H 'Content-Type: application/json' \
     -d '{
       "question": "Need a 2 bed near Seattle transit under $3000",
       "city": "Seattle",
       "state": "WA",
       "max_rent": 3000,
       "min_bedrooms": 2
     }'
   ```

The API responds with the GPT answer plus the structured property records that were provided to the model, making it easy to render or audit the recommendations.

Automated coverage lives in `tests/Feature/RentalChatTest.php` and uses a mocked OpenAI client, so you can run `php artisan test` without outbound calls.

