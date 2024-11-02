<div>
    <h2>Check</h2>

    <div>
        <input type="text" wire:model="domainInput" placeholder="inter domain">
        <button wire:click="addDomain">Add domain</button>
        <button wire:click="clearDomains">Clear</button>
    </div>

    <h3>Domains list:</h3>
    <ul>
        @foreach($domains as $domain)
            <li>{{ $domain }}</li>
        @endforeach
    </ul>

    <button wire:click="checkDomains">Check domains</button>

    <h3>Results</h3>
    <table>
        <thead>
        <tr>
            <th>Domain</th>
            <th>Available</th>
            <th>ExpirationDate</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{ $result['domain'] }}</td>
                <td>{{ $result['isAvailable'] ? 'Y' : 'N' }}</td>
                <td>{{ $result['expirationDate'] ?? 'N/A' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
